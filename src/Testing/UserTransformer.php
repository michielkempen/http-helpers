<?php

namespace MichielKempen\LaravelHttpResponses\Testing;

class UserTransformer
{
    public function transform(User $model): array
    {
        return [
            'first_name' => $model->getFirstName(),
            'last_name' => $model->getLastName(),
        ];
    }
}
