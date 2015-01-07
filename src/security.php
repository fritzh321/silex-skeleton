<?php 

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use SilexSk\WebserviceUserBundle\Security\User\WebserviceUser;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\DBAL\Connection;


class UserProvider implements UserProviderInterface
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function loadUserByUsername($username)
    {
        $stmt = $this->conn->executeQuery('SELECT * FROM t_users WHERE username = ?', array(strtolower($username)));
        $user = $stmt->fetch();

        if (!$user) {
            if($username == "NONE_PROVIDED"){
                 throw new Exception('Gebruikersnaam kan niet leeg zijn.');
            }else{
                throw new Exception('De ingevoerde gebruikersnaam of het ingevoerde wachtwoord is onjuist.');
            }
            

        }

    
        return new WebserviceUser($user['username'], $user['password'], $user['first_name'], $user['last_name'], explode(',', $user['roles']), (bool)$user['enabled'], true, true, true);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class ===  'SilexSk\WebserviceUserBundle\Security\User\WebserviceUser';;
    }
}

$app['login_path'] = '/login';
$app['login_check'] = '/secure/login_check';
$app['logout_path'] = '/secure/logout';


$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^'.$app['login_path'].'$',
        ),
        'secured' => array(
            'pattern' => '^.*$',
            'anonymous' => true,
            'form' => array('login_path' => $app['login_path'], 'check_path' => $app['login_check']),
            'logout' => array('logout_path' => $app['logout_path']),
            'users' => $app->share(function () use ($app) {
                return new UserProvider($app['db']);
            }),
        ),

    ),
    'security.access_rules' => array(
         array('^/admin', 'ROLE_ADMIN')
     ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN'    => array('ROLE_ADMIN', 'ROLE_USER' ),
        'ROLE_USER'    => array('ROLE_USER'),
    )
));





