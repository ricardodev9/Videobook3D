#API para obtener informacón de los elementos: películas, series y libros

from flask import Flask, jsonify
import imdb
import pprint
import json
import xmltodict
from imdb import IMDbError
import itertools
app =  Flask(__name__)

# home route that returns below text when root url is accessed

def search_element():
    cine = imdb.IMDb()
    #items = cine.search_movie("")
    items = cine.search_movie('Avengers')
    return items
        
    #items_json = []
    
    # try:
       
    #     item_info = {
    #         'id' : item['id'],
    #         'title': item['title'],
    #         'year': item['year'],
    #         'kind': item['kind'],
    #         'cover_url' : item['cover_url']
    #         # Agrega otros atributos según sea necesario
    #     }
    #     items_json.append(item_info)  
    #     print(item['title'])
@app.route("/")    
def show_element():
    elements = search_element()
    # Recorrer los elementos y obtener su información
    for element in elements:
        print("ID:", element.getID())  # Obtener el ID del elemento
        print("Título:", element['title'])
        print("Año:", element['year'])
        print("Tipo:", element['kind'])
        
    #     print()  # Imprimir una línea en blanco entre cada elemento
            
 
if __name__ == '__main__':  
   app.run(debug=True)