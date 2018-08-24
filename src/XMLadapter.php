<?php

namespace src;

class XMLadapter
{

    public function createPrint($inputArray)
    {

        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><xml></xml>");
        $this->addXML($inputArray, $xml);


        Header('Content-type: text/xml');
        print_r($xml->asXML());

    }

    public function create($inputArray, $fileName)
    {

        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><xml></xml>");
        $this->addXML($inputArray, $xml);


        Header('Content-type: text/xml');
        $xml->asXML($fileName);

    }

    private function addXML($inputArray, $xml)
    {

        foreach ($inputArray as $key => $value) {

            $key = str_replace(" ", "", $key);
            $key = str_replace("/", "oder", $key);


            if (is_array($value)) {

                if (is_numeric($key)) {

                    $subnode = $xml->addChild("item$key");
                    $this->addXML($value, $subnode);

                } else {

                    $subnode = $xml->addChild($key);
                    $this->addXMl($value,$subnode);
                }

            } else {

                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }

    public function read($path){

        if(file_exists($path)){

            $xml = simplexml_load_file('text.xml');
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

        } else {

            exit("Konnte $path nicht finden");
        }

        return $array;
    }
}

