<?php

namespace App\Observers;

use App\Models\NewsDraf;
use App\Service\ImageService;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

class NewsDrafObserver
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService) {
        $this->imageService = $imageService;
    }
    /**
     * Handle the NewsDraf "created" event.
     */
    public function created(NewsDraf $newsDraf): void
    {
        //
    }

    /**
     * Handle the NewsDraf "updated" event.
     */
    public function updated(NewsDraf $newsDraf): void
    {
        //
    }

    /**
     * Handle the NewsDraf "deleted" event.
     */
    public function deleted(NewsDraf $newsDraf): void
    {
        if ($newsDraf->image) {
            $this->imageService->deleteImageDirectory($newsDraf->image);
        }
    }

    /**
     * Handle the NewsDraf "restored" event.
     */
    public function restored(NewsDraf $newsDraf): void
    {
        //
    }

    /**
     * Handle the NewsDraf "force deleted" event.
     */
    public function forceDeleted(NewsDraf $newsDraf): void
    {
        //
    }
}
