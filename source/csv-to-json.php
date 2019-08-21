<?php

exit(call_user_func(
    function (string $commandName, string $filename, string $destination): int {
        if (in_array($filename, ['', '-h', '--help'], true)) {
            echo $commandName, ' transform csv to json (used for complementos.csv)', PHP_EOL,
                'Syntax: ', $commandName, ' source-file.csv', PHP_EOL,
                PHP_EOL;
            return 0;
        }
        if ('-' === $destination) {
            $destination = '';
        }
        try {
            $inputInfo = new SplFileInfo($filename);
            if ($inputInfo->isDir()) {
                throw new Exception('Invalid argument, is a directory');
            }
            if (! $inputInfo->isReadable()) {
                throw new Exception('Invalid argument, is not readable');
            }

            if ($destination !== '') {
                $outputInfo = new SplFileInfo($destination);
                $outputDirectory = new SplFileInfo($outputInfo->getPath() ?: './');
                if (! $outputDirectory->isDir() || ! $outputDirectory->isWritable()) {
                    throw new Exception('Destination directory is not writable');
                }
            }

            $contents = $inputInfo->openFile();
            $contents->setFlags(SplFileObject::READ_CSV);
            $contents->setCsvControl(',');

            $jsonData = [];
            $headers = null;
            $arrayCombine = function (array $keys, array $values): array {
                $keysCount = count($keys);
                $valuesCount = count($values);
                if ($valuesCount > $keysCount) {
                    $values = array_slice($values, 0, $keysCount);
                } elseif ($keysCount > $valuesCount) {
                    $values = $values + array_fill($valuesCount, $keysCount - $valuesCount, '');
                }
                return array_combine($keys, $values);
            };

            foreach ($contents as $data) {
                if (! is_array($data) || [] === $data || [null] === $data) {
                    continue; // skip blank line
                }
                if (null === $headers) {
                    $headers = $data;
                    continue;
                }
                $jsonData[] = array_filter($arrayCombine($headers, $data));
            }

            file_put_contents(
                $destination ?: 'php://stdout',
                json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL
            );
            
            return 0;
        } catch (Throwable $exception) {
            file_put_contents('php://stderr', 'ERROR: ' . $exception->getMessage() . PHP_EOL);
            return 1;
        }
    },
    $argv[0] ?? '',
    $argv[1] ?? '',
    $argv[2] ?? ''
));
