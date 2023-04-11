<?php

require '../vendor/autoload.php';
use Aws\S3\S3Client;

class S3
{
    private $s3;
    private $version = "latest";
    private $region = S3_REGION;
    private $bucket = S3_BUCKET;
    private $access_key = S3_ACCESS_KEY;
    private $secret_key = S3_SECRET_KEY;

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version' => $this->version,
            'region'  => $this->region,
            'credentials' => [
                'key'    => $this->access_key,
                'secret' => $this->secret_key,
            ],
        ]);
    }

    public function putObject($filename, $content)
    {
        $result = $this->s3->putObject([
            'Bucket' => $this->bucket,
            'Key'    => $filename,
            'Body'   => $content,
        ]);

        return $result;
    }

    public function getObject($filename)
    {
        $result = $this->s3->getObject([
            'Bucket' => $this->bucket,
            'Key'    => $filename
        ]);

        return $result['Body']->getContents();
    }

    public function deleteObject($filename)
    {
        try {
            $result = $this->s3->deleteObject([
                'Bucket' => $this->bucket,
                'Key'    => $filename
            ]);
            
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}
