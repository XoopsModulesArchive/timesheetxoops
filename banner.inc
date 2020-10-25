<?php
  //Get the result set for the config set 1
  [$qhq, $numq] = dbQuery("select bannerhtml from $CONFIG_TABLE where config_set_id = '1'");
  $configData = dbResult($qhq);
	parse_and_echo(stripslashes($configData['bannerhtml']));

