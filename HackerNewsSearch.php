<?php

/**
 * HN php api based on https://hn.algolia.com/api
 **/

//tags in order of x,y is a AND
//tags in order of (x,y) OR

require 'vendor/autoload.php';


class HackerNewsSearch  {


    private $endpoint = "http://hn.algolia.com/api/v1/";
    public $vector = null; ///search_by_date, search    users   items
    public $tags = null; // story    comment poll    pollopt show_hn ask_hn  front_page  author_:USERNAME    story_:ID
    public $numericFilters = null; // created_at_i, points, num_comments
    public $query = null; //front_page
    public $req = null;
    public $page = 0;
    public $results = null;

    /*
     *
     * search
     */

    public function search() {

        $this->set_vector();
        $this->set_tag();
        $this->set_query();
        $this->set_numericFilters();

        $client      = new GuzzleHttp\Client();
        $this->req   = $this->endpoint.$this->vector."{$this->query}{$this->tags}{$this->numericFilters}&hitsPerPage=5000";
        $res         = $client->get($this->req);
        $data        = $this->results = $res->json();
        return $data;
    }

    /*
     * set_tag
     *
     */
    private function set_tag() {
        if($this->tags == null){
             $this->tags = "";
        }else{
            $this->tags = "&tags=".$this->tags;
        }
    }

    /*
     * set_vector
     *
     */
    private function set_vector() {
        if($this->vector == null){
            $this->vector = "search";
        }else{
            $this->vector = $this->vector;
        }
    }

     /*
     * set_query
     *
     */
    private function set_query() {
        if($this->vector == "search" || $this->vector == "search_by_date") {
            $this->query = "?query=".$this->query;
        }else{
            $this->query = "/".$this->query;
        }
    }

     /*
     * set_numericFilters
     *
     */
    private function set_numericFilters() {
        if($this->numericFilters != null) {
            $this->numericFilters = "&numericFilters=".$this->numericFilters;
        }
    }

}
