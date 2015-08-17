<?php

namespace Intrix\EmpresaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity
 */
class Empresa {

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
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

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
     * @Assert\Url(message = "Essa site não confere. Insira 'http://' no inicio da URL")
     * @ORM\Column(name="site", type="string", length=255)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=400)
     */
    private $observacao;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @ORM\OneToMany(targetEntity="Intrix\ContatoBundle\Entity\Contato", mappedBy="empresa")
     * */
    private $contatos;

    /**
     * @ORM\ManyToOne(targetEntity="Seguimento", inversedBy="empresas")
     * @ORM\JoinColumn(name="seguimento_id", referencedColumnName="id")
     * */
    private $seguimento;

    public function __construct() {
        $this->contatos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Empresa
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Empresa
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
     * Set site
     *
     * @param string $site
     *
     * @return Empresa
     */
    public function setSite($site) {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite() {
        return $this->site;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Empresa
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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Empresa
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
     * Set seguimento
     *
     * @param \Intrix\EmpresaBundle\Entity\Seguimento $seguimento
     *
     * @return Empresa
     */
    public function setSeguimento(\Intrix\EmpresaBundle\Entity\Seguimento $seguimento = null) {
        $this->seguimento = $seguimento;

        return $this;
    }

    /**
     * Get seguimento
     *
     * @return \Intrix\EmpresaBundle\Entity\Seguimento
     */
    public function getSeguimento() {
        return $this->seguimento;
    }


    /**
     * Add contato
     *
     * @param \Intrix\ContatoBundle\Entity\Contato $contato
     *
     * @return Empresa
     */
    public function addContato(\Intrix\ContatoBundle\Entity\Contato $contato)
    {
        $this->contatos[] = $contato;
    
        return $this;
    }

    /**
     * Remove contato
     *
     * @param \Intrix\ContatoBundle\Entity\Contato $contato
     */
    public function removeContato(\Intrix\ContatoBundle\Entity\Contato $contato)
    {
        $this->contatos->removeElement($contato);
    }

    /**
     * Get contatos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContatos()
    {
        return $this->contatos;
    }
}
