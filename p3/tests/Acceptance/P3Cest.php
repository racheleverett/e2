<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class P3Cest
{
    // tests
    public function playGame(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('[id="move_x"]', '1');
        $I->fillField('[id="move_y"]', '1');
        $I->click('[id="btn_submit"]');

        $c_move = $I->grabTextFrom('[test=c-move]');
        $I->comment('Computer move is ' . $c_move);
        if ($c_move == '1-1') {
            $I->seeElement('[class="alert warning"]');
        } else {
            $I->seeElement('[test="human-move"]');
        }
    }

    public function validateForm(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('[id="btn_submit"]');
        $I->seeElement('[class="alert error"]');
    }

    public function showsHistoryAndRoundDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $roundCount = count($I->grabMultiple('.round-link'));
        $I->assertGreaterOrEquals(10, $roundCount);

        $timestamp = $I->grabTextFrom('.round-link');
        $I->click($timestamp);
        $I->see($timestamp);
        $I->see('Game Play');
    }
}
