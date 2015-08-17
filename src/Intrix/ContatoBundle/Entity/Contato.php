<?php

namespace Intrix\ContatoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contato
 *
 * @ORM\Table(name="contato")
 * @ORM\Entity(repositoryClass="Intrix\ContatoBundle\Entity\ContatoRepository")
 */
class Contato {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Esse campo não pode ficar em branco.")
     * @ORM\Column(name="falei_com", type="string", length=255, nullable=true)
     */
    private $faleiCom;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Esse campo não pode ficar em branco.")
     * @ORM\Column(name="falar_com", type="string", length=255, nullable=true)
     */
    private $falarCom;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Esse campo não pode ficar em branco.")
     * @ORM\Column(name="telefone", type="string", length=255, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @Assert\Email(message = "O email '{{ value }}' não é valido.", checkMX = true)
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="enviei_email", type="boolean", options={"default" = 0})
     * 
     */
    private $envieiEmail;

    /**
     * @var string
     *
     * @ORM\Column(
     *  name="interesse", 
     *  type="string",
     *  columnDefinition="ENUM('Bastante', 'Pouco', 'Nenhum')",
     * )
     * 
     */
    private $interesse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proximo_contato", type="datetime")
     */
    private $proximoContato;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=400)
     */
    private $observacao;

    /**
     * @ORM\ManyToOne(targetEntity="Intrix\EmpresaBundle\Entity\Empresa", inversedBy="contatos")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     * */
    private $empresa;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set faleiCom
     *
     * @param string $faleiCom
     *
     * @return Contato
     */
    public function setFaleiCom($faleiCom) {
        $this->faleiCom = $faleiCom;

        return $this;
    }

    /**
     * Get faleiCom
     *
     * @return string
     */
    public function getFaleiCom() {
        return $this->faleiCom;
    }

    /**
     * Set falarCom
     *
     * @param string $falarCom
     *
     * @return Contato
     */
    public function setFalarCom($falarCom) {
        $this->falarCom = $falarCom;

        return $this;
    }

    /**
     * Get falarCom
     *
     * @return string
     */
    public function getFalarCom() {
        return $this->falarCom;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Contato
     */
    public function setTelefone($telefone) {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone() {
        return $this->telefone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contato
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set envieiEmail
     *
     * @param boolean $envieiEmail
     *
     * @return Contato
     */
    public function setEnvieiEmail($envieiEmail) {
        $this->envieiEmail = $envieiEmail;

        return $this;
    }

    /**
     * Get envieiEmail
     *
     * @return boolean
     */
    public function getEnvieiEmail() {
        return $this->envieiEmail;
    }

    /**
     * Set interesse
     *
     * @param string $interesse
     *
     * @return Contato
     */
    public function setInteresse($interesse) {
        $this->interesse = $interesse;

        return $this;
    }

    /**
     * Get interesse
     *
     * @return string
     */
    public function getInteresse() {
        return $this->interesse;
    }

    /**
     * Set proximoContato
     *
     * @param \DateTime $proximoContato
     *
     * @return Contato
     */
    public function setProximoContato($proximoContato) {
        $this->proximoContato = $proximoContato;

        return $this;
    }

    /**
     * Get proximoContato
     *
     * @return \DateTime
     */
    public function getProximoContato() {
        return $this->proximoContato;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Contato
     */
    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Contato
     */
    public function setObservacao($observacao) {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao() {
        return $this->observacao;
    }

    /**
     * Set empresa
     *
     * @param \Intrix\ContatoBundle\Entity\Empresa $empresa
     *
     * @return Contato
     */
    public function setEmpresa(\Intrix\ContatoBundle\Entity\Empresa $empresa = null) {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Intrix\ContatoBundle\Entity\Empresa
     */
    public function getEmpresa() {
        return $this->empresa;
    }

}
