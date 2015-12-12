import java.util.*;
import java.io.*;

class Filter{
	public static void main(String[] args) throws Exception{
		BufferedReader reader = new BufferedReader(new FileReader(new File("./data/products.txt")));
		BufferedWriter writer = new BufferedWriter(new FileWriter(new File("./data/training.txt")));
		BufferedWriter writerTraining = new BufferedWriter(new FileWriter(new File("./data/training-data.txt")));
		BufferedWriter writerTesting = new BufferedWriter(new FileWriter(new File("./data/testing-data.txt")));
		String line;
		int count = 0;
		while((line = reader.readLine()) != null){
			count++;
			line = line.toLowerCase().trim();
			line = filter(line);
			writer.write(line + "\n");
			if(count <= 4000) writerTraining.write(line + "\n");
			else writerTesting.write(line + "\n");
		}
		writer.close();
		writerTraining.close();
		writerTesting.close();
		reader.close();
	}
	
	private static String filter(String line){
		line = numericFilter(line);
		line = specialCharFilter(line);
		return line;
	}
	
	private static String specialCharFilter(String line){
		String[] words = line.split(" ");
		String newLine = "";
		for(String word : words){
			word = word.replaceAll("[^a-z0-9]", "");
			if(word.length() > 2){
				newLine += word + " ";
			}
		}
		return singleSpace(newLine.trim());
	}
	
	private static String numericFilter(String line){
		return line.replaceAll("[0-9]","");
	}

	private static String singleSpace(String str){
		return str.replaceAll("  +|   +|\t|\r|\n","");
	}
}