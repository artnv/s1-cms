#include <iostream>
#include <fstream>
#include <string>
#include <vector>

using namespace std;

int main()
{
	setlocale(0,"");

	char ch,yn,itoaf[255],filename[255];
	vector<char> txt;
	string newpage;
	string infpage;
	unsigned long int page_cnt=0,i=0,start_plimit=0,end_plimit=0,razn=0,sumrazn=0,sumrazn2=0,e=0,d=0;


		system("cls");
		cout << "PageMaker 1.0\n-------------------\n\n\n";
		cout << "Пример: 30000-39999\nВведите начало лимита страниц\t: "; 
		cin >> start_plimit;
		cout << "Введите конец лимита страниц\t: "; 
		cin >> end_plimit;
		
		
		system("cls");
		cout << "PageMaker 1.0\n-------------------\n\n\n";
		cout << "Пример: 123.txt\nВведите имя файла\t: "; cin >> filename;
		cout << "\n-------------------\n";

		ifstream in(filename);
		if(!in)
		{
			system("cls");
			cout << "PageMaker 1.0\n-------------------\n\n\n";
			cout << "Невозможно открыть файл!\n";
			system("pause");
			exit(1);
		} 
		 
		
		system("cls");
		cout << "\nПодождите...\n";
		while(in.get(ch))
		{
			page_cnt++;
			txt.push_back(ch);
		}
				
			
		
		while(1)
		{
			razn = 0; sumrazn=0; sumrazn2=0;
			
			system("cls");
			cout << "PageMaker 1.0\n-------------------\n\n\n";
			cout << "Пример: 150000\nКоличество символов, по которому разобьется основной файл\t: "; 
			cin>>razn;
			
			sumrazn = page_cnt/razn;
			sumrazn2 = page_cnt%razn;
			if(sumrazn2 != 0) sumrazn++;
			
			if((start_plimit+sumrazn) < end_plimit) break;
			else 
			{
				system("cls");
				cout << "PageMaker 1.0\n-------------------\n\n\n";
				cout << "Задайте больше символов!\n";
				system("pause");
			}
		}
		
		
		
		

		system("cls");
		cout << "PageMaker 1.0\n-------------------\n\n\n";
		cout << sumrazn+sumrazn << " Файлов будет создано\n\n";
		cout << "Приступить к созданию страниц? [y/n]\t: "; 
		cin>>yn;
		if(yn == 'n') exit(1);

	
	
	
	
	system("cls");
	cout << "\nПодождите...\n";
	
	
	
	e=0; d=razn;
	for(i=0;i<sumrazn;i++)
	{
		
		start_plimit++;
		newpage = "p";
		newpage += itoa (start_plimit,itoaf,10);
		infpage = "inf";
		infpage += itoa (start_plimit,itoaf,10);
		ofstream out(newpage);
		ofstream infout(infpage);
		if(!out && !infout)
		{
			cout << "Невозможно создать файл!\n";
			system("pause");
			exit(1);
		}
		infout << "0\n\n\n\n\n\n0\n0\n0\n0";
		infout.close();

		
		for(;e<=d;e++)
		{	
			if(e<txt.size())
			{
				out << txt[e];
			} else break;
		}
		
		if(i == (sumrazn-1)) d+=sumrazn2; else d+=razn;
		out.close();	
	}
	
	
	
	
	in.close();
	txt.clear();
	system("cls");
	cout << "PageMaker 1.0\n-------------------\n\n\nГотово!\n\n\n";
	cout << "Всего созданно файлов\t: " << sumrazn+sumrazn;
	cout << "\nСтраниц\t: " << sumrazn << "\n\n\n";
	system("pause");
	
	return 0;
}