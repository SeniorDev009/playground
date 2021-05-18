<?php

namespace Bidcoz\Bundle\CoreBundle\Controller;

use Bidcoz\Bundle\CoreBundle\BidcozCoreServices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;

class CoreController extends Controller
{
    use BidcozCoreServices;

    protected function returnJson($data, $convert = false, $status = 200)
    {
        $data = $convert
            ? json_decode($data)
            : $data;

        return new JsonResponse($data, $status);
    }

    protected function returnResponse(string $data, $status = 200)
    {
        return new Response($data, $status);
    }

    protected function returnRedirect(string $url)
    {
        return new RedirectResponse($url);
    }

    protected function returnJsonSuccess($message = 'success', array $data = [])
    {
        return $this->returnJson(array_merge($data, [
            'status'  => 'ok',
            'message' => $message,
        ]));
    }

    protected function returnJsonError($errors, array $data = [])
    {
        if ($errors instanceof FormErrorIterator) {
            $errorArray = array_map(function ($error) {
                return $error->getMessage();
            }, iterator_to_array($errors));
        } elseif (is_array($errors)) {
            $errorArray = $errors;
        } else {
            $errorArray = 'Unexpected Error';
        }

        return $this->returnJson(array_merge($data, [
            'status' => 'error',
            'errors' => $errors,
        ]), false, 400);
    }

    protected function messageAccessDeniedException($message, $type = 'info')
    {
        $this->addFlash($type, $message);

        throw $this->createAccessDeniedException($message);
    }

    protected function getFormErrorMessage(FormError $error): string
    {
        $message = $error->getMessage();
        $cause   = $error->getCause();

        $path = $cause && $cause instanceof ConstraintViolation
            ? $cause->getPropertyPath()
            : null;

        return $path
            ? sprintf('%s - %s', $path, $message)
            : $message;
    }

    protected function getContainer()
    {
        return $this->container;
    }
}
