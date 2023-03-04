<?php

namespace App\Jobs;

use App\Models\MongoDb\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Product::create($this->data);
            echo 'Sync product to mongo success:'.PHP_EOL;
            echo json_encode($this->data).PHP_EOL;
        }catch (\Exception $exception){
            echo 'Oops, there is something wrong:'.PHP_EOL;
            echo $exception->getMessage().PHP_EOL;
        }
    }
}
