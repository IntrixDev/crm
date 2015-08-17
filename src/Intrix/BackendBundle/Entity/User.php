<?php

namespace Intrix\BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\ManyToMany(targetEntity="Intrix\DashboardBundle\Entity\Dashboard")
     * @ORM\JoinTable(name="user_dashboard",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="dashboard_id", referencedColumnName="id")}
     *      )
     * */
    private $dashboards;

    public function __construct() {
        $this->dashboards = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add dashboard
     *
     * @param \Intrix\BackendBundle\Entity\Dashboard $dashboard
     *
     * @return User
     */
    public function addDashboard(\Intrix\DashboardBundle\Entity\Dashboard $dashboard) {
        $this->dashboards[] = $dashboard;

        return $this;
    }

    /**
     * Remove dashboard
     *
     * @param \Intrix\BackendBundle\Entity\Dashboard $dashboard
     */
    public function removeDashboard(\Intrix\DashboardBundle\Entity\Dashboard $dashboard) {
        $this->dashboards->removeElement($dashboard);
    }

    /**
     * Get dashboards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDashboards() {
        return $this->dashboards;
    }

}
