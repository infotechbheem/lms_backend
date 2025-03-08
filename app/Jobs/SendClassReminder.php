<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClassReminder implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $student;
    protected $messageContent;
    protected $attachment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Student $student, string $messageContent, ?string $attachment)
    {
        $this->student = $student;
        $this->messageContent = $messageContent;
        $this->attachment = $attachment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $student = $this->student;
        $messageContent = $this->messageContent;
        $attachment = $this->attachment;

        // Send email to the student
        Mail::send([], [], function ($message) use ($student, $messageContent, $attachment) {
            $message->to($student->email)
                ->subject('Class Reminder')
                ->html($messageContent); // Send HTML content in email

            // Attach the file if provided
            if ($attachment) {
                $message->attach(storage_path('app/' . $attachment)); // Attach the file
            }
        });
    }
}
