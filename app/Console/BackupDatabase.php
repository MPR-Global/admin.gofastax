<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Aws\S3\S3Client;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database and upload to S3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $databaseName = env('DB_DATABASE');
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $mysqlPassword = env('DB_PASSWORD');
        $tablesToIgnore = [];
        // Generate a unique backup filename
        $backupFileName = "bkp-amistee_web_and_admin-" . date('Y-m-d_H-i-s') . '.sql.gz';

        // Initialize the S3 client
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'), // Replace with your S3 region
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $s3Bucket = env('AWS_BUCKET_DB_BACKUP');
        $s3Key = "backups/{$backupFileName}";


        // Perform the database dump
        $dumpCommand = "mysqldump -h {$host} -u {$username} -p\"{$mysqlPassword}\" {$databaseName} ";
        foreach ($tablesToIgnore as $table) {
            $dumpCommand .= "--ignore-table={$databaseName}.{$table} ";
        }
        $dumpCommand .= "| gzip > {$backupFileName}";

        $process = Process::fromShellCommandline($dumpCommand);
        $process->setTimeout(300);
        $process->run();

        \Log::info('Mysqldump output: ' . $process->getOutput());
        \Log::error('Mysqldump error output: ' . $process->getErrorOutput());
        
        if (!$process->isSuccessful()) {
            $this->error('Database backup failed.');
            return;
        }

        
        $stream = fopen($backupFileName, 'r');
        // Upload the file to S3
        $s3Client->putObject([
            'Bucket' => $s3Bucket,
            'Key'    => $s3Key,
            'Body'   => $stream,
        ]);

        fclose($stream);

        // Clean up the local backup file
        unlink($backupFileName);

        $this->info('Database backup completed and uploaded to S3.');
    }
}
