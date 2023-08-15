<?php declare(strict_types=1);

namespace Ingesting\SharedKernel\Infrastructure\EcotoneGlobal;

use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\Messaging\Handler\Recoverability\ErrorHandlerConfiguration;
use Ecotone\Messaging\Handler\Recoverability\RetryTemplateBuilder;

class EcotoneGlobalConfiguration
{
    #[ServiceContext]
    public function aggregateRepository(): DbalConfiguration
    {
        return DbalConfiguration::createWithDefaults()
            ->withDocumentStore(enableDocumentStoreAggregateRepository: true);
    }

    #[ServiceContext]
    public function globalRetryConfiguration(): ErrorHandlerConfiguration
    {
        return ErrorHandlerConfiguration::createWithDeadLetterChannel(
            'DbalErrorChannel',
            RetryTemplateBuilder::fixedBackOff(100)
                ->maxRetryAttempts(3),
            'dbal_dead_letter'
        );
    }

    #[ServiceContext]
    public function globalAsynchronousMessageChannel(): DbalBackedMessageChannelBuilder
    {
        return DbalBackedMessageChannelBuilder::create('global');
    }
}
