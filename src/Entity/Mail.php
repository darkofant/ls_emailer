<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MailRepository")
 */
class Mail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $account_id;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="mails")
     */
    private $account;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $datetime;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipients;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getSender(): ?string
    {
        return $this->sender;
    }
    
    public function setSender(string $sender): self
    {
        $this->sender = $sender;
        
        return $this;
    }
    
    public function getRecipients(): ?string
    {
        return $this->recipients;
    }
    
    public function setRecipients(string $recipients): self
    {
        $this->recipients = $recipients;
        
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->account_id;
    }
    
    public function setAccountId(int $account_id): self
    {
        $this->account_id = $account_id;
        
        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(?\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
    
    public function getType(): ?int
    {
        return $this->type;
    }
    
    public function setType(?int $type): self
    {
        $this->type = $type;
        
        return $this;
    }

    public function getNew(): ?bool
    {
        return $this->new;
    }

    public function setNew(?bool $new): self
    {
        $this->new = $new;

        return $this;
    }
}
