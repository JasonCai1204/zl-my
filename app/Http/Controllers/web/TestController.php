<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache;


class TestController extends Controller
{
    public function modifyDoctors ()
    {
        $doctors = App\Doctor::all();

        foreach ($doctors as $doctor)
        {
            $doctor->introduction = $doctor->brief."\n\n".$doctor->introduction;

            $doctor->save();

            dd('modify.doctors.ok');
        }
    }


    public function modifyOrders()
    {
        $con = mysqli_connect("localhost","admin","health;","test");

        if ($con)
        {

            $sql = "alter table orders modify reported_at TIMESTAMP NULL ";

            if (mysqli_query($con,$sql))
            {
                $sql = " UPDATE `orders` SET `reported_at`=NULL WHERE 1 ";

                if (mysqli_query($con,$sql))
                {
                   $sql = " UPDATE `orders` SET `gender`=0,`smoking`=0 WHERE 1 ";

                    if (mysqli_query($con,$sql)) {

                        $sql = " ALTER TABLE orders DROP found_at,DROP paid_at ";

                        if (mysqli_query($con,$sql))
                        {
                            $sql = "delete from orders where deleted_at >0 ";

                            if (mysqli_query($con,$sql)) {
                                dd('modify.orders.ok');
                            }else {
                                die('Could not connect: 3' . mysqli_error($con));
                            }

                        }else {
                            die('Could not connect: 2' . mysqli_error($con));
                        }

                    }else {
                        die('Could not connect: 1' . mysqli_error($con));
                    }
                }else {
                    die('2.Could not connect: ' . mysqli_error($con));
                }

            }else {
                die('1.Could not connect: ' . mysqli_error($con));
            }

        } else {
            die('Could not connect: ' . mysqli_error($con));
        }
    }


    public function updateOrders()
    {
        $con = mysqli_connect("localhost","admin","health;","test");

        if ($con)
        {

            $sql = " UPDATE `orders` SET `gender`=NULL ,`smoking`=NULL WHERE 1 ";

            if (mysqli_query($con,$sql)) {
                $sql = " alter table orders modify send_to_the_doctor TIMESTAMP NULL ";

                if (mysqli_query($con,$sql)) {
                    dd('update.orders.ok');
                }

            }else {
                die('2.Could not connect: ' . mysqli_error($con));
            }

        } else {
            die('1.Could not connect: ' . mysqli_error($con));
        }
    }

    public function moveFiles()
    {
        foreach (App\Order::all() as $order) {

            $photos = [];

            if ($order->photos != null) {
                foreach ($order->photos as $photo) {

                    $newPhoto = 'public/images/order/photos/' . Carbon::now()->timestamp . '/' . substr($photo, 38);

                    Storage::move('public' . substr($photo, 8), $newPhoto);

                    $photos[] = $newPhoto;

                }

                $order->photos = $photos;

                $order->save();
            }
        }

            foreach (App\Doctor::all() as $doctor) {


                if ($doctor->avatar == '/storage/images/doctor-avatar.jpg') {

                    $doctor->avatar = null;

                    $doctor->save();

                }

                if ($doctor->avatar != null) {
                    $newPhoto = 'public/images/doctor/avatar/' . Carbon::now()->timestamp . '/' . substr($doctor->avatar, 38);

                    $oldPhoto = 'public' . substr($doctor->avatar, 8);


                    Storage::copy($oldPhoto, $newPhoto);

                    $doctor->avatar = $newPhoto;

                    $doctor->save();
                }

            }

            foreach (App\Type::all() as $type) {

                $newIcon = 'public/images/type/icon/' . Carbon::now()->timestamp . '/' . substr($type->icon, 38);

                $oldIcon = 'public' . substr($type->icon, 8);

                Storage::move($oldIcon, $newIcon);

                $type->icon = $newIcon;

                $type->save();

            }



    }
}
