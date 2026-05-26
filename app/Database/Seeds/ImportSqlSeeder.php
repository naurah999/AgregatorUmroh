<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ImportSqlSeeder extends Seeder
{
    public function run()
    {
        $file = ROOTPATH . 'database' . DIRECTORY_SEPARATOR . 'seed.sql';

        if (! is_file($file)) {
            echo "Seed file not found: $file\n";
            return;
        }

        $sql = file_get_contents($file);
        if (trim($sql) === '') {
            echo "Seed file is empty: $file\n";
            return;
        }

        $db = \Config\Database::connect();

        // Split statements on semicolon + newline to avoid splitting inside routines.
        $statements = preg_split('/;\s*\n/', $sql);

        foreach ($statements as $stmt) {
            $stmt = trim($stmt);
            if ($stmt === '') continue;

            try {
                $db->query($stmt);
            } catch (\Exception $e) {
                // Show error but continue with other statements
                echo "Error executing statement: " . $e->getMessage() . "\n";
            }
        }

        echo "ImportSqlSeeder finished.\n";
    }
}
