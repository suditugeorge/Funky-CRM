<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Domain;
use App\Models\Channel;
use App\Models\MediaUser;
use App\Models\Link;

class MediaController extends Controller
{
    public static function addMedia($request,$contact)
    {
        try{
            $media = new Media();
            $media->office_check_in = $request->check_in == "true" ? 1:0;
            $media->affiliation = $request->affliation;
            $media->rating = $request->rating;
            $contact->media()->save($media);

            //Adaug domenii de interes
            if(isset($request->domains_of_interest) && $request->domains_of_interest != ""){
                foreach ($request->domains_of_interest as $new_domain) {
                    $domain = new Domain();
                    $domain->name = $new_domain;
                    $media->domains()->save($domain);
                }
            }

            if(isset($request->channels) && $request->channels != ""){
                foreach ($request->channels as $new_channel) {
                    $channel = new Channel();
                    $channel->name = $new_channel;
                    $media->channels()->save($channel);
                }
            }   

            
            if(isset($request->liasons) && $request->liasons != ""){
                foreach ($request->liasons as $new_liason) {
                    $liason = new MediaUser();
                    $liason->user_id = $new_liason;
                    $media->liasons()->save($liason);
                }
            }    

            if(isset($request->link) && $request->link != ""){
                $link = new Link();
                $link->url = $request->link;
                $media->links()->save($link);
            }     
            
            
            return ['success' => true];

        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ];
        }

    }

    public static function modifyMedia($request,$contact)
    {
        $media = Media::where('id','=',$request->updates['id'])->first();

        $media->office_check_in = $request->updates['check_in'] == "true" ? 1:0;
        $media->affiliation = $request->updates['affiliation'];
        $media->rating = $request->updates['rating'];
        $media->update();

        //Adaugam link nou
        if(isset($request->updates['new_link_value']) && $request->updates['new_link_value'] != ""){
            $link = new Link();
            $link->url = $request->updates['new_link_value'];
            $media->links()->save($link);
        }

        //Stergem/udpate link-uri
        if(isset($request->updates['links'])){
            foreach ($request->updates['links'] as $new_link) {
                if($new_link['link'] == ""){
                    Link::where('id','=',$new_link['id'])->first()->delete();
                }else{
                    $modified_link = Link::where('id','=',$new_link['id'])->first();
                    $modified_link->url = $new_link['link'];
                    $modified_link->update();
                }
            }
        }

        //Adaugam domenii noi
        if(isset($request->updates['domains_of_interest'])){
            foreach ($request->updates['domains_of_interest'] as $new_domain) {
                $found = false;
                foreach ($media->domains as $old_domain) {
                    if($old_domain['name'] == $new_domain){
                        $found = true;
                    }
                }
                if($found == false){
                    $domain = new Domain();
                    $domain->name = $new_domain;
                    $media->domains()->save($domain);
                }
            }
        }      

        //Stergem domenii
        foreach ($media->domains as $old_domain){
            $found = false;
            if(isset($request->updates['domains_of_interest'])){
                foreach ($request->updates['domains_of_interest'] as $new_domain){
                    if($old_domain['name'] == $new_domain){
                        $found = true;
                    }                    
                }
            }
            if($found == false){
                $old_domain->delete();
            }
        }

        //Adaugam canale noi   
        if(isset($request->updates['channels'])){
            foreach ($request->updates['channels'] as $new_channel) {
                $found = false;
                foreach ($media->channels as $old_channel) {
                    if($old_channel['name'] == $new_channel){
                        $found = true;
                    }
                }
                if($found == false){
                    $channel = new Channel();
                    $channel->name = $new_channel;
                    $media->channels()->save($channel);
                }
            }
        }         

        //Stergem canale
        foreach ($media->channels as $old_channel){
            $found = false;
            if(isset($request->updates['channels'])){
                foreach ($request->updates['channels'] as $new_channel){
                    if($old_channel['name'] == $new_channel){
                        $found = true;
                    }                    
                }
            }
            if($found == false){
                $old_channel->delete();
            }
        }

        //Adaugam liason
        if(isset($request->updates['liasons'])){
            foreach ($request->updates['liasons'] as $new_liason) {
                $found = false;
                foreach ($media->liasons as $old_liason) {
                    if($old_liason->user_id == intval($new_liason)){
                        $found = true;
                    }
                }
                if($found == false){
                    $liason = new MediaUser();
                    $liason->user_id = $new_liason;
                    $media->liasons()->save($liason);                    
                }                  
            }      
        }

        //Stergem liason
        foreach ($media->liasons as $old_liason){
            $found = false;
            if(isset($request->updates['liasons'])){
                foreach ($request->updates['liasons'] as $new_liason){
                    if($old_liason->user_id == intval($new_liason)){
                        $found = true;
                    }                    
                }
            }
            if($found == false){
                $old_liason->delete();
            }
        }        

        return ['success' => true];

    }

    public static function deleteMedia($request,$contact)
    {
        $media = Media::where('id','=',$request->id)->first();
        if(isset($media->domains)){
            foreach ($media->domains as $old_domain){
                $old_domain->delete();
            }                
        }   
        if(isset($media->channels)){
            foreach ($media->channels as $old_channel){
                $old_channel->delete();
            }                
        }   
        if(isset($media->liasons)){
            foreach ($media->liasons as $old_liason){
                $old_liason->delete();
            }                
        }
        if(isset($media->links)){
            foreach ($media->links as $old_link) {
                $old_link->delete();
            }
        }   

        $media->delete();   
        return ['success' => true];              
    }
}
