<?php

namespace UIComponent\CustomModule\Controller\Adminhtml\Data;

use UIComponent\CustomModule\Model\Data;

class MassEnable extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $data->setIsActive(true);
        $this->dataRepository->save($data);
        return $this;
    }
}

