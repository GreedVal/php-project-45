<?php

namespace Hexlet\Code\Games\Progression;

use Hexlet\Code\Engine;

const PROGRESSION_LENGTH = 10;
const MIN_POSITION = 0;
const MAX_POSITION = 9;
const MIN_STEP = 2;
const MAX_STEP = 5;
const DESCRIPTION = 'What number is missing in the progression?';


function generateProgression(int $step, int $long, int $start): array
{
    $end = $start + $step * ($long - 1);
    return range($start, $end, $step);
}

function generateQuestionAndAnswer(): array
{
    $randomPosition = rand(MIN_POSITION, MAX_POSITION);
    $randomStep = rand(MIN_STEP, MAX_STEP);

    $progression = generateProgression($randomStep, PROGRESSION_LENGTH, $randomPosition);

    $correct = (string) $progression[$randomPosition];
    $progression[$randomPosition] = '..';
    $question = implode(' ', $progression);

    $result = ['question' => $question, 'correct' => $correct];

    return $result;
}

function run(): void
{
    $questionsAndAnswers = [];

    for ($i = 1; $i <= Engine\GAME_ROUNDS; $i++) {
        $questionsAndAnswers[] = generateQuestionAndAnswer();
    }

    Engine\processGame(DESCRIPTION, $questionsAndAnswers);
}
