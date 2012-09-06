<br>
[ <a href="?action=prev">&lt;&lt;</a> ]
[ <a href="?action=play">&gt;</a> ]
[ <a href="?action=pause">||</a> ]
[ <a href="?action=next">&gt;&gt;</a> ]
<br>
[ <a href="?action=volume&volume=0">____</a> ]
[ <a href="?action=volume&volume=25">*___</a> ]
[ <a href="?action=volume&volume=50">**__</a> ]
[ <a href="?action=volume&volume=75">***_</a> ]
[ <a href="?action=volume&volume=100">****</a> ]
<br>
<br>
<?php
require('dcop.php');

$dcopAmarok = new Dcop('amarok');

switch ($_REQUEST['action'])
{
	case 'play':
		$dcopAmarok->player->play();
		break;
		
	case 'pause':
		$dcopAmarok->player->pause();
		break;
		
	case 'next':
		$dcopAmarok->player->next();
		break;
		
	case 'prev':
		$dcopAmarok->player->prev();
		break;
		
	case 'volume':
		$dcopAmarok->player->setVolume($_REQUEST['volume']);
		break;
		
	default:
		break;
}



?>
