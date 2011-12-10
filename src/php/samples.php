<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC                                      ##
## http://www.manifestinteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt                                           ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect('localhost', 'apnsuser', 'apnspassword', 'apnsdb');
$db->show_errors();

// FETCH $_GET OR CRON ARGUMENTS TO AUTOMATE TASKS
$apns = new APNS($db);

/**
/*	ACTUAL SAMPLES USING THE 'Examples of JSON Payloads' EXAMPLES (1-5) FROM APPLE'S WEBSITE.
 *	LINK:  http://developer.apple.com/iphone/library/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/ApplePushService/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW15
 */

// APPLE APNS EXAMPLE 1
$apns->newMessage(1);
$apns->addMessageAlert('Message received from Bob');
$apns->addMessageCustom('acme2', array('bang', 'whiz'));
$apns->queueMessage();

// APPLE APNS EXAMPLE 2
$apns->newMessage(1, '2010-01-01 00:00:00'); // FUTURE DATE NOT APART OF APPLE EXAMPLE
$apns->addMessageAlert('Bob wants to play poker', 'PLAY');
$apns->addMessageBadge(5);
$apns->addMessageCustom('acme1', 'bar');
$apns->addMessageCustom('acme2', array('bang', 'whiz'));
$apns->queueMessage();

// APPLE APNS EXAMPLE 3
$apns->newMessage(1);
$apns->addMessageAlert('You got your emails.');
$apns->addMessageBadge(9);
$apns->addMessageSound('bingbong.aiff');
$apns->addMessageCustom('acme1', 'bar');
$apns->addMessageCustom('acme2', 42);
$apns->queueMessage();

// APPLE APNS EXAMPLE 4
$apns->newMessage(1, '2010-01-01 00:00:00');  // FUTURE DATE NOT APART OF APPLE EXAMPLE
$apns->addMessageAlert(NULL, NULL, 'GAME_PLAY_REQUEST_FORMAT', array('Jenna', 'Frank'));
$apns->addMessageSound('chime');
$apns->addMessageCustom('acme', 'foo');
$apns->queueMessage();

// APPLE APNS EXAMPLE 5
$apns->newMessage(1);
$apns->addMessageCustom('acme2', array(5, 8));
$apns->queueMessage();

// SEND MESSAGE TO MORE THAN ONE USER
$apns->newMessage(array(1,3,4,5,8,15,16));
$apns->addMessageAlert('Greetings Everyone!');
$apns->queueMessage();

// SEND ALL MESSAGES NOW
$apns->processQueue();

?>
