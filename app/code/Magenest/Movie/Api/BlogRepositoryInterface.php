<?php

namespace Magenest\Movie\Api;

use Magenest\Movie\Api\Data\BlogInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface BlogRepositoryInterface
{
    /**
     * @param int $id
     * @return string
     */
    public function getById($id);

    /**
     * @return string
     */
    public function getList();

    /**
     * @param int $id
     * @return string
     */
    public function delete($id);

//    /**
//     * @param SearchCriteriaInterface $searchCriteria
//     * @return BlogInterface
//     */
//    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @return string
     */

    public function add();

    /**
     * @param int $id
     * @return string
     */
    public function update($id);

}
