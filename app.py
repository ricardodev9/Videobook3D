#API para obtener informacón de los elementos: películas, series y libros
import flask
from flask import Flask, request, jsonify
import requests
import imdb
import json
import xmltodict
from imdb import IMDbError
import itertools
from flask_cors import CORS
from inspect import getmembers
from pprint import pprint

app =  Flask(__name__)
CORS(app)  # Habilitar CORS para todos los endpoints
#busca el elemnto de imdb a partir de su ID     
def search_element(id):
    cine = imdb.IMDb()
    # items = cine.get_movie(id)
    try:
        items = cine.get_movie(id)
    except IMDbError as e:
        items = []
    return items

#método para obtener la compaía de la película

def get_company_by_movieID(id_imdb):
    cine = imdb.IMDb()
    try:
        comp_data = cine.get_company(id_imdb)
        company = {
            'name': comp_data.get('name','N/A'),
            'id': comp_data.getID()
        }
    except IMDbError as e:
        company = {}
    return company



#método para recoger aquellos elementos que coincidan con el buscador
def search_elements_by_name(name):
    cine = imdb.IMDb()
    try:
        items = cine.search_movie(name)
    except IMDbError as e:
        items = []
    return items

#recogemos la información del método search_element
#guardamos el cast en un array 
#guardamos los géneros en un array
#guardmamos la compañía en un array
#guardamos todo en un array
@app.route("/buscar", methods=['GET','POST'])    
def show_element():
    ia = imdb.IMDb()
    id_imdb = request.form.get('id_imdb')
    cine = ia.get_movie(id_imdb)
    result = {
        'cast': [],
        'genres': [],
        'rating': None,
        'producers': [],
        'companies': []
    }

    if 'cast' in cine:
        result['cast'] = [{"id": per.personID, "name": per['name']} for per in cine['cast']]
    
    if 'genres' in cine:
        result['genres'] = cine['genres']
    
    if 'rating' in cine:
        result['rating'] = {"rating": cine['rating']}
    
    if 'producer' in cine:
        result['producers'] = [{"id": prod.personID, "name": prod['name']} for prod in cine['producer']]
    
    if 'production companies' in cine:
        result['companies'] = [{"id": comp.companyID, "name": comp['name']} for comp in cine['production companies']]
    
    return jsonify(result)

    # ia = imdb.IMDb()
    # companies = ia.get_company('0017902')
    # pprint(getmembers(ia.get_company_infoset()))
    # return jsonify({"type" : "ok" , "msg" : "123"})

@app.route('/buscar_by_name', methods = ["POST","GET"])
def buscar_by_name():
    name = request.form.get('buscador')
    items = search_elements_by_name(name)
    result = {
        'items' : []
    }
    for i in items:
   
        result['items'].append({
            'id' : i.movieID,
            'title' : i['title'],
            'year': i.get('year', ''),  # Obtener el año si está disponible, de lo contrario, dejarlo vacío
            'type' : i['kind'],
            'img' : i['cover url'],

            })
        
    pprint(getmembers(result['cast'][0]))
    return jsonify(result)


if __name__ == '__main__':  
   app.run(debug=True)