// package src.com.example.helloworld;

import org.apache.pdfbox.cos.COSDocument;
import org.apache.pdfbox.io.RandomAccessFile;
import org.apache.pdfbox.pdfparser.PDFParser;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;

import java.io.*;
/**
 *
 * @author Hia Wei QI, Liong Man Chun, Tan YiJoe
 */
public class HelloWorld {

    /**
     * @param args the command line arguments
     */

    public static void main(String args[]) {

        PDFParser parser = null;
        PDDocument pdDoc = null;
        COSDocument cosDoc = null;
        PDFTextStripper pdfStripper;

        String parsedText;
        String fileName = "D:\\Apps\\xampp\\htdocs\\testPhpandJava\\uploads\\39_proposal_ClimateAction.pdf";
        
        File file = new File("./../../../../../uploads/pdf_to_convert.pdf");
        try {
            parser = new PDFParser(new RandomAccessFile(file, "r"));
            parser.parse();
            cosDoc = parser.getDocument();
            pdfStripper = new PDFTextStripper();
            pdDoc = new PDDocument(cosDoc);
            parsedText = pdfStripper.getText(pdDoc);
            writeFile1(parsedText); //write parsed text from pdf to txt file
        } catch (Exception e) {
            e.printStackTrace();
            try {
                if (cosDoc != null)
                    cosDoc.close();
                if (pdDoc != null)
                    pdDoc.close();
            } catch (Exception e1) {
                e1.printStackTrace();
            }
        }
    }

    public static void writeFile1(String txtToWrite) throws IOException {
        File fout = new File("./../../../../../download/out.txt");
        FileOutputStream fos = new FileOutputStream(fout);

        BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(fos));
        bw.write(txtToWrite);
        System.out.println("Wrote!\n");
        bw.close();
    }

}
