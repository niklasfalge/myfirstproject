<?php

namespace src;

class csvAdapter {


    public function read($path){


        if(file_exists($path)){

            $fp = fopen($path, 'r');
            $columns = fgetcsv($fp, 1000, ",");


            foreach ($columns as $key => $value){

                if($columns[$key]==""){

                    unset($columns[$key]);
                }
            }


            $counter = 0;
            $outputArray = [[]];

            while ($data = fgetcsv($fp, 1000, ",")){


                array_splice($data, count($columns));


                foreach ($data as $key => $value){

                    if(intval($value) != 0){

                        if(strpos($value,'.') || strpos($value,',')){
                            $data[$key] = (float)$value;
                        }
                        else {
                            $data[$key] = (int)$value;
                        }

                    }
                }

                $row = array_combine($columns, $data);

                $outputArray[$counter] = $row;

                $counter++;

            }

        } else {
            echo "File '$path' does not exist";
        }

        return $outputArray;
    }




    public function create($inputArray, $fileName){

        $fp = fopen($fileName, 'w');

        fputcsv($fp, array_keys($inputArray[0]));

        foreach ($inputArray as $value){
            fputcsv($fp, $value);
        }

        fclose($fp);

        echo "CSV file has been created";
    }
}

$csvObj = new csvAdapter();

$csvObj->read('/Users/niklasfalge/www/myfirstproject/Hund_Pflege.csv');
