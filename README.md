
# Roomba Test

  This code contains Roomba simulator as demanded in task.

## Requirements
**Required:**
- PHP 7.1 or newer

**Optional:**
- [Composer](https://getcomposer.org/) (to run PHPUnit tests)


## CLI Method

  **How to run it through CLI:**
`php cleaning_robot.php input-filepath output-filepath`

Where the first parameter is JSON file as input. The second parameter is JSON file of output which will be created.

Example:
`php cleaning_robot.php test1.json test1_result.json`

## UI Method
When you have a server running, visit `index.php` which contains basic Bootstrap UI for comfortable testing.

## API (Somehow) Method
Send input (see a section lower) through POST variable names `data` to:
`http://roomba.rychecky.cz/cleaning_robot.php`
or run your very own `cleaning_robot.php` on your server.

![](http://roomba.rychecky.cz/resources/post.png)

## PHPUnit Tests
In case you want to run PHPUnit tests, install [Composer](https://getcomposer.org/) and run: `composer install` from project folder.

Then run `phpunit` in order to execute all PHPUnit tests contained in `/tests` folder.

![](http://roomba.rychecky.cz/resources/phpunit.png)

## Input
Standard input data are in JSON format like this:
```json
{
  "map": [
 ["S", "S", "S", "S"],
 ["S", "S", "C", "S"],
 ["S", "S", "S", "S"],
 ["S", "null", "S", "S"]
 ],  "start": {"X": 3, "Y": 0, "facing": "N"},
  "commands": [ "TL","A","C","A","C","TR","A","C"],
  "battery": 80
}```