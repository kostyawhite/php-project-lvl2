<?php

namespace Gendiff\GenDiff;
use Docopt;

const DOC = "Generate diff

Usage:
    gendiff (-h|--help)
    gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
    -h --help                     Show this screen
    --format <fmt>                Report format [default: pretty]";

function run()
{
    $args = Docopt::handle(DOC);
    $first = file_get_contents($args->args['<firstFile>']);
    $second = file_get_contents($args->args['<secondFile>']);

    echo genDiffJson($first, $second);
}

function genDiffJson($first, $second)
{
    $firstJson = json_decode($first, true);
    $secondJson = json_decode($second, true);
    $result = "";
    $mergedJson = array_merge($firstJson, $secondJson);
    foreach ($mergedJson as $key => $value) {
        // prevent bool value converting to 0 or 1
        if (is_bool($value)) {
            $value = ($value === true) ? "true" : "false";
        }
        if (!array_key_exists($key, $firstJson)) {
            $result .= " + $key: $value\n";
        } elseif (!array_key_exists($key, $secondJson)) {
            $result .= " - $key: $value\n";
        } elseif ($firstJson[$key] === $secondJson[$key]) {
            $result .= "   $key: $value\n";
        } else {
            $result .= " + $key: $value\n";
            $result .= " - $key: $firstJson[$key]\n";
        }
    }

    return "{\n" . $result . "}\n";
    // return $result;
}
