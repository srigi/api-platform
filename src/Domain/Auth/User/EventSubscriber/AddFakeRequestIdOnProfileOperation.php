<?php declare(strict_types = 1);

namespace App\Domain\Auth\User\EventSubscriber;

use App\Domain\Auth\User\ProfileController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AddFakeRequestIdOnProfileOperation implements EventSubscriberInterface
{

    private const PRIORITY = 5; // priority must be above of ApiPlatform\Core\EventListener\ReadListener::onKernelRequest !!!

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', self::PRIORITY],
            ],
        ];
    }

    public function onKernelRequest(KernelEvent $event): void
    {
        $request = $event->getRequest();
        $routeName = $request->attributes->get('_route');
        if ($routeName !== ProfileController::PROFILE_ROUTE_NAME) {
            return;
        }

        /*
         * Add fake UUID to the request since ProfileController::__invoke() is an "item operation"
         * which requires a {id} parameter in the request. For more details inspect:
         *   - ApiPlatform\Core\EventListener\ReadListener::onKernelRequest()
         *   - ApiPlatform\Core\DataProvider\OperationDataProviderTrait::extractIdentifiers()
         */
        $request->attributes->set('id', '00000000-0000-0000-0000-000000000000');
    }

}
