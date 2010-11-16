<?php

class eViasWeb_View_Helper_WidgetTwitter
    extends Zend_View_Helper_Abstract
{
    private $_statusUpdates = null;
    private $_followers     = null;

    public function widgetTwitter($full = true)
    {
        $html = "";

        if ($full) {
            $html .= $this->renderLastPosts();
            $html .= $this->renderFollowers();
        }
        else {
            // render small widget
            $html .= $this->renderSmall();
        }

        return $html;
    }

    public function renderSmall()
    {
        $html = "";

        $userIntro= eVias_Service_Twitter::getInstance()->getUserIntro();
        $lastPost = eVias_Service_Twitter::getInstance()->getLastPostxml();

        $html .= "<h3><a href='http://www.twitter.com/eVias' target='blank'>$userIntro</a></h3>";
        $html .= "<span class='tweet'>" . $lastPost->text . "</span>";

        return $html;
    }

    public function renderLastPosts()
    {
        $html = "";

        if (is_null($this->_statusUpdates)) {
            $this->_statusUpdates = eVias_Service_Twitter::getInstance()
                                        ->getTimelineXml()->status;
        }

        if (empty($this->_statusUpdates)) {
            return $html;
        }

        $userIntro= eVias_Service_Twitter::getInstance()->getUserIntro();
        $lastPost = eVias_Service_Twitter::getInstance()->getLastPostXml();

        $max = 5;
        $i   = 0;
        $html .= "
            <h3>Derniers statuts Twitter</h3>
            <ul class='posts'>
        ";
        foreach ($this->_statusUpdates as $idx => $statusUpdate) {

            if ($i == $max) break;

            $statusText = $statusUpdate->text;

            $html .= "
                <li class='tweetblock'>
                    <span class='tweet'>- $statusText</span>
                </li>
            ";

            $i++;
        }
        $html .= "</ul>";

        return $html;
    }

    public function renderFollowers()
    {
        $html = "";

        if (is_null($this->_followers)) {
            $this->_followers = eVias_Service_Twitter::getInstance()
                                    ->getFollowersXml()->user;
        }

        if (empty($this->_followers)) {
            return $html;
        }

        $html .= "
            <h3>Liste de followers</h3>
            <ul class='followers'>
        ";
        foreach ($this->_followers as $idx => $followerXml) {
            $followerNick= $followerXml->screen_name;
            $profileLink = "http://www.twitter.com/$followerNick";
            $profileImg  = $followerXml->profile_image_url;

            $html .= "
                <li>
                    <a href='$profileLink' target='blank'>
                        <img src='$profileImg' alt='$followerNick' />
                    </a>
                </li>
            ";
        }
        $html .= "</ul>";
        $html .= "<div class='clear'></div>";

        return $html;
    }

}

