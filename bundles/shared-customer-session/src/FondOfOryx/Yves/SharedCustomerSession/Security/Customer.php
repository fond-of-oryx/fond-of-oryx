<?php

namespace FondOfOryx\Yves\SharedCustomerSession\Security;

use Generated\Shared\Transfer\CustomerTransfer;
use Symfony\Component\Security\Core\User\UserInterface;

class Customer implements UserInterface
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransfer;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $roles = [];

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param string $username
     * @param string $password
     * @param array $roles
     */
    public function __construct(CustomerTransfer $customerTransfer, $username, $password, array $roles = [])
    {
        $this->customerTransfer = $customerTransfer;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return array<string>
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransfer()
    {
        return $this->customerTransfer;
    }
}
