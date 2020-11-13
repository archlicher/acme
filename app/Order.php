<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //  (FedEx, UPS, DHL)
    protected $fillable = [
        'orderNumber',
        'invoiceNumber',
        'totalAmount',
        'customerName',
        'trackingNumber',
        'shippingDate',
        'shippingMethod',
        'deliveryDate',
        'owner',
        'orderStatus'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function transaction($request)
    {
        \DB::transaction(function () {
            \DB::table('orders')->where('id', $this->id)->update(['trackingNumber' => $request->trackingNumber]);
            \DB::table('orders')->where('id', $this->id)->update(['shippingDate' => $request->shippingDate]);
            \DB::table('orders')->where('id', $this->id)->update(['deliveryDate' => $request->deliveryDate]);
            if (in_array($request->shippingMethod, ['FedEx', 'UPS', 'DHL']))
            {
                DB::table('orders')->where('id', $this->id)->update(['shippingMethod' => $request->shippingMethod]);
            } else {
                \DB::rollback();
            }
        });
    }

    public function addTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        $this->save();

        return $this;
    }

    public function addShippingDate($shippingDate)
    {
        $this->shippingDate = $shippingDate;
        $this->save();

        return $this;
    }

    public function addShippingMethod($shippingMethod)
    {
        if ($this->shippingMethod === null)
        {
            if (in_array($shippingMethod, ['FedEx', 'UPS', 'DHL']))
            {
                $this->shippingMethod = $request->shippingMethod;
                $this->save();
            } else {
                return 'Unsupported method of delivery';
            }
        } else {
            return 'Shipping method defined';
        }

        return $this;
    }

    public function addDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
        $this->save();

        return $this;
    }

    public function checkStatus()
    {
        return $this->orderStatus;
    }
}
