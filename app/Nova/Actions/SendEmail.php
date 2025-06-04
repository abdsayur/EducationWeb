<?php

namespace App\Nova\Actions;

use App\Mail\CustomEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SendEmail extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $attachmentPath = null;

        if ($fields->attachment) {
            // Store the uploaded file in 'public' disk and get the path
            $attachmentPath = $fields->attachment->store('attachments', 'email-attachment');
        }

        foreach ($models as $model) {
            // Assuming your model has an 'email' attribute
            Mail::to($model->email)->send(
                new CustomEmail(
                    $fields->subject,
                    $fields->message,
                    $attachmentPath
                )
            );
        }

        return Action::message('Emails sent successfully!');
    }


    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Subject')
                ->rules('required', 'max:255'),

            Textarea::make('Message')
                ->rules('required'),

            File::make('Attachment')
                ->disk('email-attachment')  // or 's3' / 'local' etc.
                ->nullable(),
        ];
    }
}
