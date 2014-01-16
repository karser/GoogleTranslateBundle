<?php
namespace Karser\GoogleTranslateBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Karser\GoogleTranslateBundle\Entity\Translation;
use Doctrine\Orm\EntityManager;
use Karser\GoogleTranslateBundle\Exception\GoogleTranslateException;

class TranslateManager
{
    const ENDPOINT = 'https://www.googleapis.com/language/translate/v2';

    /** @var string */
    protected $api_key;

    /** @var ObjectManager */
    protected $em;

    public function __construct(ObjectManager $em, $api_key)
    {
        $this->em = $em;
        $this->api_key = $api_key;
    }

    /**
     * @param string $data
     * @param string $target
     * @param string $source
     * @return string
     * @throws GoogleTranslateException
     */
    public function translate($data, $target, $source = '')
    {
        $rep = $this->em->getRepository('KarserGoogleTranslateBundle:Translation');
        $translation = $rep->findOneBy([
            'source' => $source,
            'target' => $target,
            'original' => $data
        ]);
        if (empty($translation)) {
            try {
                $translated = $this->query($data, $target, $source);
            } catch (\Exception $e) {
                throw new GoogleTranslateException($e->getMessage());
            }
            $translation = new Translation();
            $translation->setSource($source);
            $translation->setTarget($target);
            $translation->setOriginal($data);
            $translation->setTranslated($translated);
            $this->em->persist($translation);
            $this->em->flush();
        }

        return $translation->getTranslated();
    }

    private function query($data, $target, $source = '')
    {
        $values = array(
            'key'    => $this->api_key,
            'target' => $target,
            'q'      => $data
        );

        if (!empty($source)) {
            $values['source'] = $source;
        }

        $client = new \Guzzle\Http\Client();
        $request = $client->post(self::ENDPOINT, ['X-HTTP-Method-Override' => 'GET'], $values);
        $response = $request->send();
        $json = $response->getBody(true);
        $data = json_decode($json, true);

        if (empty($data['data'])) {
            throw new \Exception('Bad Google Translate response');
        }

        return $data['data']['translations'][0]['translatedText'];
    }
} 