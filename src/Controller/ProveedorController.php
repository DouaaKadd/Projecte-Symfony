<?php

namespace App\Controller;

use App\Repository\ProveedorRepository;
use App\Entity\Proveedor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ProveedorController extends AbstractController
{
/**
     * @Route("/proveedor", name="app_proveedor")
     */
    public function index(ProveedorRepository $proveedorRepository): Response
    {
        $proveedores = $proveedorRepository->findAll();

        return $this->render('proveedor/index.html.twig', [
            'proveedores' => $proveedores,
        ]);
    }

    /**
     * @Route("/proveedor/crear", name="crear_proveedor")
     */
    public function crear(Request $request): Response
    {

        return $this->render('proveedor/crear.html.twig');
    }

    /**
     * @Route("/proveedor/guardar", name="guardar_proveedor", methods={"POST"})
     */
    public function guardar(Request $request, EntityManagerInterface $entityManager): Response
    {
     
        $nombre = $request->request->get('nombre');
        $correo_electronico = $request->request->get('correo_electronico'); 
        $telefono_contacto = $request->request->get('telefono_contacto');
        $tipo = $request->request->get('tipo');
        $activo = $request->request->get('activo') === '1';

        $proveedor = new Proveedor();

        $proveedor->setNombre($nombre);
        $proveedor->setCorreoElectronico($correo_electronico); 
        $proveedor->setTelefonoContacto($telefono_contacto); 
        $proveedor->setTipoProveedor($tipo);
        $proveedor->setActivo($activo);

        $entityManager->persist($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('app_proveedor');
    }

    /**
     * @Route("/proveedor/eliminar/{id}", name="eliminar_proveedor")
     */
    public function eliminar($id, EntityManagerInterface $entityManager): Response
    {
        $proveedor = $entityManager->getRepository(Proveedor::class)->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        $entityManager->remove($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('app_proveedor');
    }

    /**
     * @Route("/proveedor/editar/{id}", name="editar_proveedor", methods={"PUT", "POST"})
     */
    public function editar(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $proveedor = $entityManager->getRepository(Proveedor::class)->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        return $this->render('proveedor/editar.html.twig', [
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * @Route("/proveedor/actualizar", name="actualizar", methods={"PUT","POST"})
     */
    public function actualizar(Request $request, EntityManagerInterface $entityManager): Response
    {
             
        $id = $request->request->get('id');
        $nombre = $request->request->get('nombre');
        $correo_electronico = $request->request->get('correo_electronico');
        $telefono_contacto = $request->request->get('telefono_contacto');
        $tipo = $request->request->get('tipo');
        $activo = $request->request->get('activo') === '1';
    
        $proveedor = $entityManager->getRepository(Proveedor::class)->find($id);

        $proveedor->setNombre($nombre);
        $proveedor->setCorreoElectronico($correo_electronico); 
        $proveedor->setTelefonoContacto($telefono_contacto); 
        $proveedor->setTipoProveedor($tipo);
        $proveedor->setActivo($activo);

        $entityManager->persist($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('app_proveedor');
    }

}
