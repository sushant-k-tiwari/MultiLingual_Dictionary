//
// Created by ramji on 4/27/2023.
//
#include "iostream"
#include "string"
using namespace std;
const int htSize =2;
class Employee{
public:
    int empID;
    string name;
    string branch;
    Employee *next;
    Employee(int empID,string name,string branch ){
        this->empID = empID;
        this->name = name;
        this->branch = branch;
        this->next = nullptr;
    }

};
Employee *emp[htSize];
int Hashfunction(int a){
    return a%htSize;
}
void insert(int empID,string name,string branch){
     Employee *newEmp = new Employee(empID,name,branch);
     int hashvalue = Hashfunction(empID);
     if(emp[hashvalue] == nullptr){
         emp[hashvalue] = newEmp;
     }else{
         Employee * curEmp =emp[hashvalue];
         while(curEmp->next != nullptr){
             curEmp=curEmp->next;
         }
         curEmp->next=newEmp;
     }

}
void search(int id){
    int hashvalue = Hashfunction(id);
    Employee *curEmp = emp[hashvalue];
    while (curEmp->next != nullptr){
        if(curEmp->empID == id){
            cout<<"Found :"<<endl;
            cout<<"empID :"<<curEmp->empID<<endl;
            cout<<"Name :"<<curEmp->name<<endl;
            cout<<"Branch :"<<curEmp->branch<<endl;
            return;
        }
        curEmp = curEmp->next;
    }
    cout<<"NO entry"<<endl;
}
int main(){
    insert(1,"Ankit","CSE");
    insert(2,"Prashant","CSE");
    insert(3,"Aman","CSE");
    insert(4,"Kanhaiya","CSE");
    insert(5,"Jayanth","CSE");
    insert(6,"Sushant","CSE");
    insert(7,"Swarn","ECE");
    insert(8,"Nitin","ECE");
    insert(9,"Aryan","ECE");
    search(2);
    search(1);
    search(6);
    search(10);
    return 0;
}