<?php

/*
 * Made by M4ciej
 */

/**
 *
 * @author m4ciej
 */
interface InterfaceRepository {
    public function add($item);
    public function findBy($id);
    public function delete($item);
    public function findAll();
}
