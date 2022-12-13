# Project 3

- By: Rachel Everett
- URL: <http://e2p3.racheleverett.me>

## Graduate requirement

_x one of the following:_

- [x] I have integrated testing into my application
- [ ] I am taking this course for undergraduate credit and have opted out of integrating testing into my application

## Outside resources

n/a

## Notes for instructor

n/a

## Codeception testing output

```
TEST conflicting cells working

Codeception PHP Testing Framework v5.0.5 https://helpukrainewin.org

Tests.Acceptance Tests (1) ---------------------------------------------------------------------------------
P3Cest: Play game
Signature: Tests\Acceptance\P3Cest:playGame
Test: tests/Acceptance/P3Cest.php:playGame
Scenario --
 I am on page "/"
 I fill field "[id="move_x"]","1"
 I fill field "[id="move_y"]","1"
 I click "[id="btn_submit"]"
 I grab text from "[test=c-move]"
 Computer move is 1-1
 I see element "[class="alert warning"]"
 PASSED

------------------------------------------------------------------------------------------------------------
Time: 00:00.109, Memory: 10.00 MB

OK (1 test, 1 assertion)
```

```
TEST suman move working

Codeception PHP Testing Framework v5.0.5 https://helpukrainewin.org

Tests.Acceptance Tests (1) ---------------------------------------------------------------------------------
P3Cest: Play game
Signature: Tests\Acceptance\P3Cest:playGame
Test: tests/Acceptance/P3Cest.php:playGame
Scenario --
 I am on page "/"
 I fill field "[id="move_x"]","1"
 I fill field "[id="move_y"]","1"
 I click "[id="btn_submit"]"
 I grab text from "[test=c-move]"
 Computer move is 0-1
 I see element "[test="human-move"]"
 PASSED

------------------------------------------------------------------------------------------------------------
Time: 00:00.118, Memory: 10.00 MB

OK (1 test, 1 assertion)
```

```
P3Cest: Shows history
Signature: Tests\Acceptance\P3Cest:showsHistory
Test: tests/Acceptance/P3Cest.php:showsHistory
Scenario --
 I am on page "/history"
 I grab multiple ".round-link"
 I assert greater or equals 10,20
 PASSED

------------------------------------------------------------------------------------------------------------
Time: 00:00.198, Memory: 10.00 MB
```

```
P3Cest: Shows history and round details
Signature: Tests\Acceptance\P3Cest:showsHistoryAndRoundDetails
Test: tests/Acceptance/P3Cest.php:showsHistoryAndRoundDetails
Scenario --
 I am on page "/history"
 I grab multiple ".round-link"
 I assert greater or equals 10,20
 I grab text from ".round-link"
 I click "2022-12-11 23:52:14"
 I see "2022-12-11 23:52:14"
 I see "Game Play"
 PASSED

------------------------------------------------------------------------------------------------------------
Time: 00:00.205, Memory: 10.00 MB
```

```
P3Cest: Validate form
Signature: Tests\Acceptance\P3Cest:validateForm
Test: tests/Acceptance/P3Cest.php:validateForm
Scenario --
 I am on page "/"
 I click "[id="btn_submit"]"
 I see element "[class="alert error"]"
 PASSED
```
