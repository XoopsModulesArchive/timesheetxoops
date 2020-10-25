<?php

/**
 * Abstract class Command representing a command in a command menu
 */
class Command
{
    public $text;

    public $enabled;

    public function __construct($text, $enabled)
    {
        $this->text = str_replace(' ', '&nbsp;', $text);

        $this->enabled = $enabled;
    }

    public function toString()
    {
        if (!$this->enabled) {
            return "<span class=\"command_current\">$this->text</span>";
        }
  

        return $this->text;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}

/*	A class which represents a single command in a command menu.
*		It has a url and a visual reprenstation (text)
*/
class TextCommand extends Command
{
    public $url;

    /**
     * Constructor
     * @param mixed $text
     * @param mixed $enabled
     * @param mixed $url
     */

    public function __construct($text, $enabled, $url)
    {
        parent::__construct($text, $enabled);

        $this->url = $url;
    }

    public function toString()
    {
        if (!$this->enabled) {
            return parent::toString();
        }
  

        return '<a href="' . $this->url . '" class="command">' . $this->text . '</a>';
    }
}

class IconTextCommand extends TextCommand
{
    public $img;

    /**
     * Constructor
     * @param mixed $text
     * @param mixed $enabled
     * @param mixed $url
     * @param mixed $img
     */

    public function __construct($text, $enabled, $url, $img)
    {
        parent::__construct($text, $enabled, $url);

        $this->img = $img;
    }

    public function toString()
    {
        if (true) {
            return parent::toString();
        }
  

        return '<img src="' . $this->img . '" align="absbottom">' . parent::toString();
    }
}

/*	A class representing a menu of commands.
*		It's responsible for printing the menu with a separator
*/
class CommandMenu
{
    //array which holds the commands in the menu

    public $commands = [];

    /* adds a command to the menu	*/

    public function add($command)
    {
        $this->commands[] = $command;
    }

    /* returns the command menu as html */

    public function toString()
    {
        $printedFirstCommand = false;

        $returnString = '';

        //iterate through commands

        $count = count($this->commands);

        for ($i = 0; $i < $count; $i++) {
            //only print the separator after printing the first command

            if ($printedFirstCommand) {
                $returnString .= '&nbsp;&nbsp; ';
            } else {
                $printedFirstCommand = true;
            }

            //append this command to the string

            $returnString .= $this->commands[$i]->toString();
        }

        //return the command menu as a string

        return $returnString;
    }

    /**
     * Disables a menu command with the given text
     * @param mixed $text
     */

    public function disableCommand($text)
    {
        //iterate through commands

        $count = count($this->commands);

        for ($i = 0; $i < $count; $i++) {
            if ($this->commands[$i]->text == $text) {
                $this->commands[$i]->setEnabled(false);
            }
        }
    }

    public function disableSelf()
    {
        //iterate through commands

        $count = count($this->commands);

        for ($i = 0; $i < $count; $i++) {
            $self = $_SERVER['PHP_SELF'];

            $slashPos = mb_strrpos($self, '/');

            if (!is_bool($slashPos)) {
                $self = mb_substr($self, $slashPos + 1);
            }

            $url = $this->commands[$i]->url;

            $pos = mb_strpos($url, $self);

            if (!is_bool($pos) && 0 == $pos) {
                $this->commands[$i]->setEnabled(false);
            }
        }
    }
}

//create the command menu object so that those files which include this one dont need to
$commandMenu = new CommandMenu();
