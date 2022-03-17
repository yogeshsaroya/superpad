<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\GoogleAnalyticsAdmin;

class GoogleAnalyticsAdminV1alphaCreateUserLinkRequest extends \Google\Model
{
  public $notifyNewUser;
  public $parent;
  protected $userLinkType = GoogleAnalyticsAdminV1alphaUserLink::class;
  protected $userLinkDataType = '';

  public function setNotifyNewUser($notifyNewUser)
  {
    $this->notifyNewUser = $notifyNewUser;
  }
  public function getNotifyNewUser()
  {
    return $this->notifyNewUser;
  }
  public function setParent($parent)
  {
    $this->parent = $parent;
  }
  public function getParent()
  {
    return $this->parent;
  }
  /**
   * @param GoogleAnalyticsAdminV1alphaUserLink
   */
  public function setUserLink(GoogleAnalyticsAdminV1alphaUserLink $userLink)
  {
    $this->userLink = $userLink;
  }
  /**
   * @return GoogleAnalyticsAdminV1alphaUserLink
   */
  public function getUserLink()
  {
    return $this->userLink;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAnalyticsAdminV1alphaCreateUserLinkRequest::class, 'Google_Service_GoogleAnalyticsAdmin_GoogleAnalyticsAdminV1alphaCreateUserLinkRequest');
