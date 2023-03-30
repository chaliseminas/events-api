<?php 
namespace App\Models;
use CodeIgniter\Model;

class EventModel extends Model {
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'start_date', 'end_date', 'event_picture', 'tickets_type', 'tickets_price'];
}