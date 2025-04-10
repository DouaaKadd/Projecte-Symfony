<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProveedorRepository::class)
 */
class Proveedor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correo_electronico;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono_contacto;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipoProveedor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    // Constantes para el tipo de proveedor
    const TIPO_HOTEL = 'hotel';
    const TIPO_PISTA = 'pista';
    const TIPO_COMPLEMENTO = 'complemento';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correo_electronico;
    }

    public function setCorreoElectronico(string $correo_electronico): self
    {
        $this->correo_electronico = $correo_electronico;
        return $this;
    }

    public function getTelefonoContacto(): ?string
    {
        return $this->telefono_contacto;
    }

    public function setTelefonoContacto(string $telefono_contacto): self
    {
        $this->telefono_contacto = $telefono_contacto;
        return $this;
    }

    public function getTipoProveedor(): ?string
    {
        return $this->tipoProveedor;
    }

    public function setTipoProveedor(string $tipoProveedor): self
    {
        // Aquí valido que el tipo sea uno de los valores predefinidos
        if (!in_array($tipoProveedor, [self::TIPO_HOTEL, self::TIPO_PISTA, self::TIPO_COMPLEMENTO])) {
            throw new \InvalidArgumentException('Tipo de proveedor no válido');
        }
        $this->tipoProveedor = $tipoProveedor;
        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;
        return $this;
    }

}
