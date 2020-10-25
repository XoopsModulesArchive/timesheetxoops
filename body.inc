<?php
  //Get the result set for the config set 1
  [$qhq, $numq] = dbQuery("select bodyhtml from $CONFIG_TABLE where config_set_id = '1'");
  $configdata = dbResult($qhq);
	echo stripslashes($configdata['bodyhtml']);

