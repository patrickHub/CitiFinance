import io

array_of_country_phpfile = open('countries_list.php', 'w')

array_of_country_phpfile.write('<?php\n')
array_of_country_phpfile.write('$countries = [\n')

with io.open('countries.txt', 'r', newline=None) as list_of_country_txtfile:

    for country in list_of_country_txtfile:
        country = country.replace('\n', '')
        array_of_country_phpfile.write('        ')
        array_of_country_phpfile.write('\"' + country + '\"')
        array_of_country_phpfile.write(' => ')
        array_of_country_phpfile.write('\"' + country + '\",')
        array_of_country_phpfile.write('\n')

array_of_country_phpfile.write('        ];')
array_of_country_phpfile.write('\n')
array_of_country_phpfile.write('?>')

array_of_country_phpfile.close()
