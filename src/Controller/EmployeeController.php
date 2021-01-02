<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Hash;

/**
 * Employee Controller
 *
 * @property \App\Model\Table\EmployeeTable $Employee
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $employee = $this->paginate($this->Employee);
        $employee = Hash::map($employee->toArray(),"{n}",function($emp){
              $emp->image = stream_get_contents($emp->image);
              return $emp;
        });
        $employee->image = stream_get_contents($employee->image);
        $this->set(compact('employee'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employee->get($id, [
            'contain' => [],
        ]);
        $employee->image = stream_get_contents($employee->image);
        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      try {
        $employee = $this->Employee->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employee->patchEntity($employee, $this->request->getData());
            if($employee->errors()) {
                 $validationError = implode(",",array_keys($employee->errors()));
                  $this->Flash->error(__("Please check the following field(s) - ".$validationError));
            }
            if ($this->Employee->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
        }
      }
        catch(\Exception $ex){
          echo "<pre>";
          print_r($ex);
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }

        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employee->get($id, [
            'contain' => [],
        ]);
        $employee->image = stream_get_contents($employee->image);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employee->patchEntity($employee, $this->request->getData());
            if($employee->errors()) {
              $validationError = implode(",",array_keys($employee->errors()));
                  $this->Flash->error(__("Please check the following field(s) - ".$validationError));
            }
            if ($this->Employee->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employee->get($id);
        if ($this->Employee->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
