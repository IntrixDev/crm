<?php

namespace Intrix\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguimento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Seguimento {

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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="Empresa", mappedBy="seguimento")
     * */
    private $empresas;

    public function __construct() {
        $this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Seguimento
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Seguimento
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }


    /**
     * Add empresa
     *
     * @param \Intrix\EmpresaBundle\Entity\Empresa $empresa
     *
     * @return Seguimento
     */
    public function addEmpresa(\Intrix\EmpresaBundle\Entity\Empresa $empresa)
    {
        $this->empresas[] = $empresa;
    
        return $this;
    }

    /**
     * Remove empresa
     *
     * @param \Intrix\EmpresaBundle\Entity\Empresa $empresa
     */
    public function removeEmpresa(\Intrix\EmpresaBundle\Entity\Empresa $empresa)
    {
        $this->empresas->removeElement($empresa);
    }

    /**
     * Get empresas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }
}
