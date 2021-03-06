<?php
/**
 * Copyright 2018 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


require_once __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Debugger\BreakpointStorage\FileBreakpointStorage;
use Psr\Log\AbstractLogger;

/**
 * Test logger class that dumps the log to the output page for testing.
 */
class EchoLogger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        printf('[%s] %s %s' . PHP_EOL, $level, $message, json_encode($context));
    }
}

$agent = new Google\Cloud\Debugger\Agent([
  'sourceRoot' => realpath('../'),
  'storage' => new FileBreakpointStorage(),
  'logger' => new EchoLogger()
]);
