<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(name="harp_member", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"User_id", "Project_id"})})
 * @ORM\Entity
 */
class Member
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Role_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $role;
    
     /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Project_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="MemberHasTask", mappedBy="member", cascade={"remove", "persist"})
     */
    private $memberHasTasks;
    
    /**
     * Define the relation between this member and tasks it has created
     * 
     * @ORM\OneToMany(targetEntity="Task", mappedBy="creator")
     */
    private $createdTasks;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    
    public function __construct() {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Member
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Member
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set role
     *
     * @param \Harproject\AppBundle\Entity\Role $role
     * @return Member
     */
    public function setRole(\Harproject\AppBundle\Entity\Role $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Harproject\AppBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set user
     *
     * @param \Harproject\AppBundle\Entity\User $user
     * @return Member
     */
    public function setUser(\Harproject\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Harproject\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param \Harproject\AppBundle\Entity\Project $project
     * @return Member
     */
    public function setProject(\Harproject\AppBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Harproject\AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     * @return Member
     */
    public function addMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks[] = $memberHasTasks;

        return $this;
    }

    /**
     * Remove memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     */
    public function removeMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks->removeElement($memberHasTasks);
    }

    /**
     * Get memberHasTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberHasTasks()
    {
        return $this->memberHasTasks;
    }

    /**
     * Add createdTasks
     *
     * @param \Harproject\AppBundle\Entity\Task $createdTasks
     * @return Member
     */
    public function addCreatedTask(\Harproject\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks[] = $createdTasks;

        return $this;
    }

    /**
     * Remove createdTasks
     *
     * @param \Harproject\AppBundle\Entity\Task $createdTasks
     */
    public function removeCreatedTask(\Harproject\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks->removeElement($createdTasks);
    }

    /**
     * Get createdTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedTasks()
    {
        return $this->createdTasks;
    }
}
