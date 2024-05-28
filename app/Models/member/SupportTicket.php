<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'support_tickets';

    protected $fillable = [
        'ticket_username',
        'ticket_no',
        'replied_by',
        'ticket_subject',
        'replied_by_username',
        'user_type',
        'ticket_status',
        'ticket_message',
        'ticket_section',
        'ticket_attachment',
        'created_at',
    ];
   

}
