<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="harp_task")
 * @ORM\Entity
 */
class Task {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Define the relation between this task and users that are attributed to it
     * 
     * @ORM\OneToMany(targetEntity="MemberHasTask", mappedBy="task", cascade={"remove", "persist"})
     */
    private $memberHasTasks;

    /**
     * Define the relation between this task and it's attached project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Project_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $project;

    /**
     * Define the relation between this task and it's owner (i.e: it's author)
     * 
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="createdTasks" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Author_id", referencedColumnName="id", nullable=false)
     * }) 
     */
    private $author;


    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="parent")
     **/
    private $children;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Parent_id", referencedColumnName="id", nullable=true)
     * })* 
     **/
    private $parent;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * Estimated task duration in hour or fraction of hour
     * 
     * @var float
     *
     * @ORM\Column(name="estimated_time", type="float")
     */
    private $estimated_time;

    /**
     * Time spended on this task in hour or fraction of hour.
     * Could be 1,2,3... or 0.1, 0.2 ...
     * 
     * @var float
     *
     * @ORM\Column(name="spent_time", type="float")
     */
    private $spent_time;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    public function __construct() {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->estimated_time = 0;
        $this->spent_time = 0;
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Member
     */
    public function setCreatedAt($createdAt) {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Member
     */
    public function setUpdatedAt($updatedAt) {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set estimated_time
     *
     * @param float $estimatedTime
     * @return Task
     */
    public function setEstimatedTime($estimatedTime) {
        $this->estimated_time = $estimatedTime;

        return $this;
    }

    /**
     * Get estimated_time
     *
     * @return float 
     */
    public function getEstimatedTime() {
        return $this->estimated_time;
    }

    /**
     * Set spent_time
     *
     * @param float $spentTime
     * @return Task
     */
    public function setSpentTime($spentTime) {
        $this->spent_time = $spentTime;

        return $this;
    }

    /**
     * Get spent_time
     *
     * @return float 
     */
    public function getSpentTime() {
        return $this->spent_time;
    }

    /**
     * Add memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     * @return Task
     */
    public function addMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks) {
        $this->memberHasTasks[] = $memberHasTasks;

        return $this;
    }

    /**
     * Remove memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     */
    public function removeMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks) {
        $this->memberHasTasks->removeElement($memberHasTasks);
    }

    /**
     * Get memberHasTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberHasTasks() {
        return $this->memberHasTasks;
    }

    /**
     * Set creator
     *
     * @param \Harproject\AppBundle\Entity\Member $creator
     * @return Task
     */
    public function setCreator(\Harproject\AppBundle\Entity\Member $creator = null) {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \Harproject\AppBundle\Entity\Member 
     */
    public function getCreator() {
        return $this->creator;
    }

    /**
     * Set project
     *
     * @param \Harproject\AppBundle\Entity\Project $project
     * @return Task
     */
    public function setProject(\Harproject\AppBundle\Entity\Project $project = null) {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Harproject\AppBundle\Entity\Project 
     */
    public function getProject() {
        return $this->project;
    }


    /**
     * Set author
     *
     * @param \Harproject\AppBundle\Entity\Member $author
     * @return Task
     */
    public function setAuthor(\Harproject\AppBundle\Entity\Member $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Harproject\AppBundle\Entity\Member 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add children
     *
     * @param \Harproject\AppBundle\Entity\Task $children
     * @return Task
     */
    public function addChild(\Harproject\AppBundle\Entity\Task $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Harproject\AppBundle\Entity\Task $children
     */
    public function removeChild(\Harproject\AppBundle\Entity\Task $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Harproject\AppBundle\Entity\Task $parent
     * @return Task
     */
    public function setParent(\Harproject\AppBundle\Entity\Task $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Harproject\AppBundle\Entity\Task 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
