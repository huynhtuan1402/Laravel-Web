<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $email;
    // public function __construct($email)
    // {
    //     $this->email = $email;
    // }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */


    public function envelope()
    {
        return new Envelope(
            from: new Address('huynhquangtuan1402@gmail.com','Huynh Tuan'), //email và tên người gửi
            subject: 'Thư cảm ơn', // tiêu đề của của mail
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.send_email', // nếu không có dòng này thì lấy cả html
            text: 'emails.send_email', // lấy nội dung mail từ view send_email ra để gửi
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
